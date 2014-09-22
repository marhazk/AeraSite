/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class ChatBroadCast extends Protocol
/*    */ {
/*    */   public byte channel;
/*    */   public byte emotion;
/*    */   public int srcroleid;
/*    */   public Octets msg;
/*    */   public Octets data;
/*    */ 
/*    */   public ChatBroadCast()
/*    */   {
/* 18 */     this.msg = new Octets();
/* 19 */     this.data = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 24 */     os.marshal(this.channel);
/* 25 */     os.marshal(this.emotion);
/* 26 */     os.marshal(this.srcroleid);
/* 27 */     os.marshal(this.msg);
/* 28 */     os.marshal(this.data);
/* 29 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 34 */     this.channel = os.unmarshal_byte();
/* 35 */     this.emotion = os.unmarshal_byte();
/* 36 */     this.srcroleid = os.unmarshal_int();
/* 37 */     os.unmarshal(this.msg);
/* 38 */     os.unmarshal(this.data);
/* 39 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 46 */       ChatBroadCast o = (ChatBroadCast)super.clone();
/* 47 */       o.msg = ((Octets)this.msg.clone());
/* 48 */       o.data = ((Octets)this.data.clone());
/* 49 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 52 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.ChatBroadCast
 * JD-Core Version:    0.6.2
 */