/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GMGetGameAttriArg extends Rpc.Data
/*    */ {
/*    */   public int gmroleid;
/*    */   public int localsid;
/*    */   public byte attribute;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 20 */     os.marshal(this.gmroleid);
/* 21 */     os.marshal(this.localsid);
/* 22 */     os.marshal(this.attribute);
/* 23 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 28 */     this.gmroleid = os.unmarshal_int();
/* 29 */     this.localsid = os.unmarshal_int();
/* 30 */     this.attribute = os.unmarshal_byte();
/* 31 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 38 */       return (GMGetGameAttriArg)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 42 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMGetGameAttriArg
 * JD-Core Version:    0.6.2
 */