<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/7/12
 * Time: 17:26
 */

require_once('./mns-autoloader.php');
use AliyunMNS\Client;
use AliyunMNS\Topic;
use AliyunMNS\Constants;
use AliyunMNS\Model\MailAttributes;
use AliyunMNS\Model\SmsAttributes;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Requests\PublishMessageRequest;
class PublishBatchSMSMessageDemo
{
    public function run()
    {
        /**
         * Step 1. 初始化Client
         */
        $this->endPoint = "http://1527086795950979.mns.cn-hangzhou.aliyuncs.com/"; // eg. http://1234567890123456.mns.cn-shenzhen.aliyuncs.com
        $this->accessId = "LTAI0oMk3ej1JKKY";
        $this->accessKey = "IioKvmVyQcEJYO4dERwYgB7vFpSB6e";
        $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
        /**
         * Step 2. 获取主题引用
         */
        $topicName = "sms.topic-cn-hangzhou";
        $topic = $this->client->getTopicRef($topicName);
        /**
         * Step 3. 生成SMS消息属性
         */
        // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
        $batchSmsAttributes = new BatchSmsAttributes("Master", "SMS_77250007");
        // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
        $batchSmsAttributes->addReceiver("13266692913", array("code" => "123456"));
        $batchSmsAttributes->addReceiver("13510589015", array("code" => "456789"));
        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
        /**
         * Step 4. 设置SMS消息体（必须）
         *
         * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
         */
        $messageBody = "您的验证码为$\\{code\\}，请勿泄露验证码，验证码5分钟内有效";
        /**
         * Step 5. 发布SMS消息
         */
        $request = new PublishMessageRequest($messageBody, $messageAttributes);
        try
        {
            $res = $topic->publishMessage($request);
            echo $res->isSucceed();
            echo "\n";
            echo $res->getMessageId();
            echo "\n";
        }
        catch (MnsException $e)
        {
            echo $e;
            echo "\n";
        }
    }
}
$instance = new PublishBatchSMSMessageDemo();
$instance->run();
